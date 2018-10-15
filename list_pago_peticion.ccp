<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Grid id="47" secured="False" sourceType="Table" returnValueType="Number" connection="Datos" dataSource="detalle_pago, bancos, formas_pago, previsiones, usuarios" name="detalle_pago_bancos_forma" wizardCaption="Lista de Detalle Pago, Bancos, Formas Pago, Previsiones, Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="detalle_pago_bancos_forma">
			<Components>
				<Label id="103" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="76" visible="True" name="Sorter_fecha_ingreso" column="fecha_ingreso" wizardCaption="Fecha Ingreso" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha_ingreso" PathID="detalle_pago_bancos_formaSorter_fecha_ingreso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="77" visible="True" name="Sorter_nom_forma_pago" column="nom_forma_pago" wizardCaption="Nom Forma Pago" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_forma_pago" PathID="detalle_pago_bancos_formaSorter_nom_forma_pago">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="83" visible="True" name="Sorter_num_cheque_bono" column="num_cheque_bono" wizardCaption="Num Cheque Bono" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="num_cheque_bono" PathID="detalle_pago_bancos_formaSorter_num_cheque_bono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="81" visible="True" name="Sorter_valor" column="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="valor" PathID="detalle_pago_bancos_formaSorter_valor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="82" visible="True" name="Sorter_fecha_documento" column="fecha_documento" wizardCaption="Fecha Documento" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha_documento" PathID="detalle_pago_bancos_formaSorter_fecha_documento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="80" visible="True" name="Sorter_nom_usuario" column="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_usuario" PathID="detalle_pago_bancos_formaSorter_nom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="97" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_pago_peticion.ccp" visible="Yes" PathID="detalle_pago_bancos_formaImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="98" sourceType="DataField" name="detalle_pago_id" source="detalle_pago_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="84" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha_ingreso" fieldSource="fecha_ingreso" wizardCaption="Fecha Ingreso" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="85" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_forma_pago" fieldSource="nom_forma_pago" wizardCaption="Nom Forma Pago" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_banco" fieldSource="nom_banco" wizardCaption="Nom Banco" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="87" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="92" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="num_cheque_bono" fieldSource="num_cheque_bono" wizardCaption="Num Cheque Bono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="90" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="valor" fieldSource="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" format="$0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha_documento" fieldSource="fecha_documento" wizardCaption="Fecha Documento" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="89" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_usuario" fieldSource="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="88" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="False" name="observacion" fieldSource="observacion" wizardCaption="Observacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="93" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="subTotal" wizardTheme="Inline" wizardThemeType="File" format="$0">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="121"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="112" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Saldo" wizardTheme="Inline" wizardThemeType="File" format="$0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="113" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkAAbonos" wizardTheme="Inline" wizardThemeType="File" hrefSource="detalle_pago_peticiones.ccp" visible="Yes" PathID="detalle_pago_bancos_formalnkAAbonos">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="117" sourceType="URL" name="peticion_id" source="peticion_id"/>
						<LinkParameter id="120" sourceType="URL" name="s_peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="114" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkADetPet" wizardTheme="Inline" wizardThemeType="File" hrefSource="det_Peticion.ccp" visible="Yes" PathID="detalle_pago_bancos_formalnkADetPet">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="118" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="115" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkAddPago" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_pago_peticion.ccp" visible="Yes" PathID="detalle_pago_bancos_formalnkAddPago">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="119" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="122"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="94" conditionType="Parameter" useIsNull="False" field="detalle_pago.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="peticion_id" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="62" tableName="detalle_pago" posWidth="137" posHeight="261" posLeft="10" posTop="10"/>
				<JoinTable id="64" tableName="bancos" posWidth="100" posHeight="100" posLeft="433" posTop="16"/>
				<JoinTable id="66" tableName="formas_pago" posWidth="100" posHeight="100" posLeft="198" posTop="14"/>
				<JoinTable id="68" tableName="previsiones" posWidth="100" posHeight="100" posLeft="426" posTop="126"/>
				<JoinTable id="70" tableName="usuarios" posWidth="100" posHeight="100" posLeft="214" posTop="185"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="72" fieldLeft="detalle_pago.banco_id" fieldRight="bancos.banco_id" tableLeft="detalle_pago" tableRight="bancos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="73" fieldLeft="detalle_pago.forma_pago_id" fieldRight="formas_pago.forma_pago_id" tableLeft="detalle_pago" tableRight="formas_pago" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="74" fieldLeft="detalle_pago.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="detalle_pago" tableRight="previsiones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="75" fieldLeft="detalle_pago.usuario_id" fieldRight="usuarios.usuario_id" tableLeft="detalle_pago" tableRight="usuarios" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="63" tableName="detalle_pago" fieldName="detalle_pago.*"/>
				<Field id="65" tableName="bancos" fieldName="nom_banco"/>
				<Field id="67" tableName="formas_pago" fieldName="nom_forma_pago"/>
				<Field id="69" tableName="previsiones" fieldName="nom_prevision"/>
				<Field id="71" tableName="usuarios" fieldName="nom_usuario"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="list_pago_peticion.php" comment="//" codePage="utf-8" forShow="True" url="list_pago_peticion.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="list_pago_peticion_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="123" groupID="4"/>
		<Group id="124" groupID="5"/>
		<Group id="125" groupID="6"/>
		<Group id="126" groupID="7"/>
		<Group id="127" groupID="8"/>
		<Group id="128" groupID="9"/>
		<Group id="129" groupID="10"/>
		<Group id="130" groupID="11"/>
		<Group id="131" groupID="12"/>
		<Group id="132" groupID="13"/>
		<Group id="133" groupID="14"/>
		<Group id="134" groupID="15"/>
		<Group id="135" groupID="16"/>
		<Group id="136" groupID="17"/>
		<Group id="137" groupID="18"/>
		<Group id="138" groupID="19"/>
		<Group id="139" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="140"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
