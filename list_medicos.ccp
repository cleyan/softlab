<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="8" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="medicos_especialidadesSearch" wizardCaption="Buscar Medicos, Especialidades " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="list_medicos.ccp" PathID="medicos_especialidadesSearch">
			<Components>
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_medico" wizardCaption="Nom Medico" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="medicos_especialidadesSearchs_nom_medico">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="11" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_especialidad_id" wizardCaption="Especialidad Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="especialidades" boundColumn="especialidad_id" textColumn="nom_especialidad" orderBy="nom_especialidad" visible="Yes" PathID="medicos_especialidadesSearchs_especialidad_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="9" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="medicos_especialidadesSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="medicos, especialidades" name="medicos_especialidades" pageSizeLimit="100" wizardCaption="Lista de Medicos, Especialidades " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" PathID="medicos_especialidades">
			<Components>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="medicos_especialidades_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="13"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="17" visible="True" name="Sorter_nom_medico" column="nom_medico" wizardCaption="Nom Medico" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_medico" PathID="medicos_especialidadesSorter_nom_medico">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_nom_especialidad" column="nom_especialidad" wizardCaption="Nom Especialidad" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_especialidad" PathID="medicos_especialidadesSorter_nom_especialidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="19" visible="True" name="Sorter_fono" column="fono" wizardCaption="Fono" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fono" PathID="medicos_especialidadesSorter_fono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="20" visible="True" name="Sorter_email" column="email" wizardCaption="Email" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="email" PathID="medicos_especialidadesSorter_email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_activo" column="medicos.activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="activo" PathID="medicos_especialidadesSorter_activo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="33" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_medicos.ccp" visible="Yes" PathID="medicos_especialidadesImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="34" sourceType="DataField" name="medico_id" source="medico_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_medico" fieldSource="nom_medico" wizardCaption="Nom Medico" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_especialidad" fieldSource="nom_especialidad" wizardCaption="Nom Especialidad" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="fono" fieldSource="fono" wizardCaption="Fono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="email" fieldSource="email" wizardCaption="Email" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="activo" fieldSource="activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="30" type="Simple" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" size="10" pageSizes="1;5;10;25;50" PathID="medicos_especialidadesNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="nom_medico" parameterSource="s_nom_medico" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="medicos.especialidad_id" parameterSource="s_especialidad_id" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="medicos" posWidth="125" posHeight="230" posLeft="10" posTop="10"/>
				<JoinTable id="5" tableName="especialidades" posWidth="100" posHeight="100" posLeft="166" posTop="13"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="7" fieldLeft="medicos.especialidad_id" fieldRight="especialidades.especialidad_id" tableLeft="medicos" tableRight="especialidades" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="4" tableName="medicos" fieldName="medicos.*"/>
				<Field id="6" tableName="especialidades" fieldName="nom_especialidad"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<ImageLink id="31" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="ImageLink1" wizardTheme="InLine" wizardThemeType="File" hrefSource="add_medicos.ccp" visible="Yes" PathID="ImageLink1">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="32" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink2" wizardTheme="InLine" wizardThemeType="File" hrefSource="menu_principal.ccp" visible="Yes" PathID="ImageLink2">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="list_medicos_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="list_medicos.php" comment="//" codePage="utf-8" forShow="True" url="list_medicos.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="35" groupID="17"/>
		<Group id="36" groupID="18"/>
		<Group id="37" groupID="19"/>
		<Group id="38" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="39"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
