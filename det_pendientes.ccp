<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" isService="False">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="bitacora, estados, usuarios" name="bitacora_estados_usuarios" pageSizeLimit="100" wizardCaption="Lista de Bitacora, Estados, Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="bitacora_estados_usuarios">
			<Components>
				<Label id="23" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="bitacora_estados_usuarios_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="12"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="14" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="bitacora_estados_usuariosSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_nom_estado" column="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_estado" PathID="bitacora_estados_usuariosSorter_nom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_nom_usuario" column="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_usuario" PathID="bitacora_estados_usuariosSorter_nom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="18" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_usuario" fieldSource="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Label1" wizardTheme="Inline" wizardThemeType="File" fieldSource="tipo_bitacora_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="bitacora_estados_usuariosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="bitacora.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="peticion_id" orderNumber="1"/>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="bitacora.tipo_bitacora_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" defaultValue="1" parameterSource="1" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="bitacora" posWidth="131" posHeight="222" posLeft="10" posTop="10"/>
				<JoinTable id="5" tableName="estados" posWidth="100" posHeight="100" posLeft="339" posTop="165"/>
				<JoinTable id="7" tableName="usuarios" posWidth="253" posHeight="144" posLeft="261" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="9" fieldLeft="bitacora.estado_id" fieldRight="estados.estado_id" tableLeft="bitacora" tableRight="estados" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="10" fieldLeft="bitacora.usuario_id" fieldRight="usuarios.usuario_id" tableLeft="bitacora" tableRight="usuarios" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="4" tableName="bitacora" fieldName="bitacora.*"/>
				<Field id="6" tableName="estados" fieldName="nom_estado"/>
				<Field id="8" tableName="usuarios" fieldName="nom_usuario"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="det_pendientes_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="det_pendientes.php" comment="//" codePage="utf-8" forShow="True" url="det_pendientes.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="27"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
